Benchmarks
##########


::

    func BenchmarkXxx(*testing.B)

实例::

    func BenchmarkHello(b *testing.B) {
        for i := 0; i < b.N; i++ {
            fmt.Sprintf("hello")
        }
    }

If a benchmark needs some expensive setup before running, the timer may be reset::

    func BenchmarkBigLen(b *testing.B) {
        big := NewBig()
        b.ResetTimer()
        for i := 0; i < b.N; i++ {
            big.Len()
        }
    }

If a benchmark needs to test performance in a parallel setting::

    func BenchmarkTemplateParallel(b *testing.B) {
        templ := template.Must(template.New("test").Parse("Hello, {{.}}!"))
        b.RunParallel(func(pb *testing.PB) {
            var buf bytes.Buffer
            for pb.Next() {
                buf.Reset()
                templ.Execute(&buf, "World")
            }
        })
    }


性能测试实例:

.. literalinclude:: /files/golangs/benchmark_test.go
   :language: go
   :linenos:









